import { Injectable } from '@angular/core';
import {
  PartialTaskInterface,
  TaskInterface,
} from '../interfaces/TaskInterface';
import { HttpClient } from '@angular/common/http';
import { Observable, Subject } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class DataTasksService {
  private formValues$ = new Subject<any>();
  private deleteTaskId$ = new Subject<string>();
  static url = 'http://localhost:3000/tasks';
  constructor(private httpClient: HttpClient) {}
  /**
   * Fait une requête http get pour récupérer les tâches depuis le serveur et renvoie un observable auquel on peut s'abonner
   * @returns Observable<TaskInterface[]>
   */
  loadTasks(): Observable<TaskInterface[]> {
    const params = { status: 'PENDING' };
    return this.httpClient.get<Array<TaskInterface>>(DataTasksService.url, {
      params,
    });
  }
  deleteTask(id: string): Observable<TaskInterface> {
    const params = { status: 'PENDING' };
    return this.httpClient.delete<TaskInterface>(
      DataTasksService.url + '/' + id,
      {
        params,
      }
    );
  }
  /**
   * Fait une requête http patch pour modifer une tâche sur le serveur et renvoie un observable auquel on peut s'abonner
   * @param id
   * @param modifiedObject
   * @returns Observable<TaskInterface>
   */
  patchTask(
    id: string,
    modifiedObject: PartialTaskInterface
  ): Observable<TaskInterface> {
    const params = { status: 'PENDING' };
    return this.httpClient.patch<TaskInterface>(
      DataTasksService.url + '/' + id,
      modifiedObject,
      {
        params,
      }
    );
  }
  /**
   * Emet une notifaction next avec pour valeur "values". Dans cet exemple, c'est le composant FormAdd qui demande l'émission de la notification.
   * Les notifications (next, error, complete) seront reçues par tous les composants qui se sont abonnés (todoList)
   * @param values
   */
  setFormValues(values: any): void {
    this.formValues$.next(values);
  }
  setDeleteTaskId(id: string): void {
    this.deleteTaskId$.next(id);
  }
  /**
   * Renvoie un observable auquel on peut s'abonner (todoList)
   * @returns  Observable
   */
  getFormValuesObservable(): Observable<any> {
    return this.formValues$.asObservable();
  }
  getDeleteTaskIdObservable(): Observable<string> {
    return this.deleteTaskId$.asObservable();
  }
  /**
   * Fait une requête http post pour ajouter une tâche sur le serveur et renvoie un observable auquel on peut s'abonner
   * @param newObject
   * @returns Observable<TaskInterface>
   */
  postTask(newObject: PartialTaskInterface): Observable<TaskInterface> {
    const params = { status: 'PENDING' };
    return this.httpClient.post<TaskInterface>(
      DataTasksService.url,
      newObject,
      {
        params,
      }
    );
  }
}
