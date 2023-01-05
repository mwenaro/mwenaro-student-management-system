import { useState, FC } from "react";
import * as XLSX from "xlsx";

const useFetchExcelData = () => {
  const [data, setData] = useState();
  const [error, setError] = useState("");

  const readData = (file: any, header = false) =>
    new Promise((resolve, reject) => {
      const fileReader = new FileReader();
      fileReader.readAsArrayBuffer(file);
      fileReader.onload = (e: any) => {
        const wb = XLSX.read(e.result, { type: "buffer" });
        setError("");
        const data = {};
        let options: {
          blankrows: boolean;
          header?: number;
        } = { blankrows: false };
        if (header) {
          options.header = 1;
        }

        for (let sheetName of wb.SheetNames) {
          let sheetData = XLSX.utils.sheet_to_json(
            wb.Sheets[sheetName],
            options
          );

          if (sheetData.length > 0) {
            data[sheetName] = sheetData;
          }
        }
        return resolve(data);
      };

      fileReader.onerror = (err: any) => {
        setError(err.message);
        return reject(err.message);
      };
    });

  const handleChange = async (e: any) => {
    const d: any = await readData(e.target.files[0]);
    setData(d);
  };
  const excelInputField: FC = () => (
    <input
      type="file"
      name="myFile"
      placeholder="Pick File"
      onChange={handleChange}
      className="p-5 "
      accept=".xlsx, .xls,.csv"
    />
  );

  return {
    excelInputField,
    data,
    error,
  };
};

export default useFetchExcelData;
