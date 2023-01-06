import { ReactNode } from "react";

interface IProps {
  children: ReactNode;
}

export default function SiteGradient({ children }: IProps) {
  return (
    <div className="p-5 h-fit min-h-screen flex flex-col items-center justify-center bg-gradient bg-gradient-to-b from-mygrad-start to-mygrad-end">
      {children}
    </div>
  );
}
