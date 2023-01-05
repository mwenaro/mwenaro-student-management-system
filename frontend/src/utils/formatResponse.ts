const formatErrorResponse = (error: any) => {
  const message =
    (error.response && error.response.data && error.response.data.MESSAGE) ||
    error.data?.MESSAGE ||
    error.MESSAGE ||
    error.toString();
  return message;
};

export default formatErrorResponse;
