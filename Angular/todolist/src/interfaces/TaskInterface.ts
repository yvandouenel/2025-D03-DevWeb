export interface TaskInterface {
  id: string;
  name: string;
  done: boolean;
  comment?: string;
}

//  interface qui indique une sous-partie de TaskInterface
export interface PartialTaskInterface extends Partial<TaskInterface> {}
