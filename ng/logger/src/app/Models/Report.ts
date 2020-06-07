import { Batch } from "./Batch";

export interface Report {
  batch: Batch;
  id: number;
  message: string;
  completed: boolean;
  data: string;
}
