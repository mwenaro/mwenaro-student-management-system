import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";

// Define a service using a base URL and expected endpoints
export const studentApi = createApi({
  reducerPath: "studentsApi",
  baseQuery: fetchBaseQuery({ baseUrl: "http://localhost:1570/api/v0/" }),
  //   baseQuery: fetchBaseQuery({ baseUrl: 'http://pokeapi.co/api/v2/' }),
  endpoints: (builder) => ({
    getStudentsByForm: builder.query({
      query: (form) => `students/form/${form}`,
    }),
    getStudentByADM: builder.query({
      query: (adm) => `students/adm/${adm}`,
    }),
    getStudentById: builder.query({
      query: (id) => `students/${id}`,
    }),
    getStudents: builder.query({
      query: () => `students/`,
    }),
  }),
});

// Export hooks for usage in functional components, which are
// auto-generated based on the defined endpoints
export const {
  useGetStudentsByFormQuery,
  useGetStudentByADMQuery,
  useGetStudentByIdQuery,
  useGetStudentsQuery,
} = studentApi;
