export type ObjType = undefined | null | any;

export default function isEmptyObject(obj: ObjType) {
  if (obj === undefined || obj === null) return true;
  return !Object.keys(obj).length;
}
