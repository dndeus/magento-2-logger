export interface Batch {
  id: number;
  type: BatchType;
  date: string;
  successful_imports: number;
  failed_imports: number;
}

export interface BatchType {
  machine_name: string;
  label: string;
}
