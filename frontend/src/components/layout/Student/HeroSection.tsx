import { useEffect, useState } from "react";
import { useFetchExcelData } from "hooks";
import { Students } from "./Student";

const HeroSection = () => {
  const [items, setItems] = useState([]);
  const { data, excelInputField } = useFetchExcelData();

  useEffect(() => {
    setItems((data && Object.keys(data)) || []);
    console.log(data);
  }, [data]);

  return (
    <div className=" ">
      {excelInputField("")}
      <hr />

      <div className="p-5 bg-[#000] text-[#fff] flex flex-row items-center justify-center">
        {items.map((row, i) => (
          <div className="flex " key={i}>
            <h3>
              Row {i + 1} - {row}
            </h3>
          </div>
        ))}
      </div>
      <hr />

      <div className="bg-black flex flex-col items-center justify-center mt-20">
        <h2>Students</h2>
        <Students />
      </div>
    </div>
  );
};

export default HeroSection;
