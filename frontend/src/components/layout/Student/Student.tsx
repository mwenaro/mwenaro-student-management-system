import {
  useGetStudentByIdQuery,
  useGetStudentsQuery,
} from "services/studentAPI";

export function Students() {
  const { data: students } = useGetStudentsQuery("");
  const { data: student } = useGetStudentByIdQuery(156);

  return (
    <div className=" bg-black text-white">
      <h2>Hello therfe</h2>
      <div className="flex">
        <div className="w-1/2">
          {students &&
            students.map((std: any, i: number) => (
              <p className="" key={i}>
                {std.studentId} {std.first_name}
              </p>
            ))}
        </div>
        <div
          className="w-1/2"
          style={{ backgroundColor: "red", color: "white" }}
        >
          {student && (
            <p>
              {student.first_name} {student.last_name}
            </p>
          )}
        </div>
      </div>
    </div>
  );
}
