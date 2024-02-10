export const makeIsoTimestamp = (d: Date) =>
  `${d.toISOString().split("Z")[0]}+00:00`;

export const makeDateString = (d: Date) =>
  `${d.getFullYear()}-${
    d.getMonth() + 1 < 10 ? `0${d.getMonth() + 1}` : `${d.getMonth() + 1}`
  }-${d.getDate() < 10 ? `0${d.getDate()}` : `${d.getDate()}`}`;

export const makeTimeString = (d: Date) =>
  `${d.getHours() < 10 ? `0${d.getHours()}` : `${d.getHours()}`}-${
    d.getMinutes() < 10 ? `0${d.getMinutes()}` : `${d.getMinutes()}`
  }-${d.getSeconds() < 10 ? `0${d.getSeconds()}` : `${d.getSeconds()}`}`;

export const makeDatetimeString = (d: Date) =>
  `${makeDateString(d)} ${makeTimeString(d)}`;
