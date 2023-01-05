const dev = {
  API_BASE_URL: "http://127.0.0.1:1211/api/",
  CLIENT_BASE_URL: "http://localhost:3000",
};

const prod = {
  API_BASE_URL: "",
  CLIENT_BASE_URL: "",
};
export interface Env {
  API_BASE_URL: string;
  CLIENT_BASE_URL: string;
}

const getEnv = (): Env | any => {
  switch (process.env.NODE_ENV) {
    case "development":
      return dev;
    case "production":
      return prod;
    default:
      break;
  }
};

export const env = getEnv();
