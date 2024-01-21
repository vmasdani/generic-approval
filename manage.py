#!/usr/bin/python3

import json
import sys
import subprocess
import os

def read_config(env):
    with open('config.json', 'r') as file:
        config = json.load(file)
    return config['env'][env]

def process_template(template_path, dest_path, config):
    with open(template_path, 'r') as file:
        content = file.read()
    for key, value in config.items():
        content = content.replace(f'#{key}', value)
    with open(dest_path, 'w') as file:
        file.write(content)

def run_action(folder, command):
    original_path = os.getcwd()
    os.chdir(folder)
    subprocess.run(command, shell=True)
    os.chdir(original_path)

def main(action, component, env):
    config = read_config(env)
    templates = {
        'backend.env.template': './backend/.env',
        'admin.frontend.env.template': './admin/.env',
        'app.frontend.env.template': './app/.env'
    }

    for template, destination in templates.items():
        process_template(template, destination, config)

    actions = {
        'run': {
            'backend': 'php artisan serve',
            'admin': 'yarn dev',
            'app': 'yarn dev'
        },
        'build': {
            'backend': 'zip -r release.zip .',
            'admin': 'yarn build && zip -r release.zip ./dist',
            'app': 'yarn build && zip -r release.zip ./dist'
        }
    }

    run_action(component, actions[action][component])

if __name__ == "__main__":
    if len(sys.argv) != 4:
        print("Usage: ./manage.py <action> <component> <env>")
    else:
        _, action, component, env = sys.argv
        main(action, component, env)
