export const intlFormat = (params: {
  date: any;
  dateStyle: any;
  timeStyle: any;
}) => {
  try {
    return Intl.DateTimeFormat("en-US", {
      dateStyle: params.dateStyle,
      timeStyle: params.timeStyle,
    }).format(new Date(params.date));
  } catch (e) {
    return null;
  }
};

