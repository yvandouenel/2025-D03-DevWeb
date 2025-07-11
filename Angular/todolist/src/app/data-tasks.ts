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
  static url = 'http://localhost:3000/tasks';
  constructor(private http: HttpClient) {}
  /**
   * Fait une requête http get pour récupérer les tâches depuis le serveur et renvoie un observable auquel on peut s'abonner
   * @returns Observable<TaskInterface[]>
   */
  loadTasks(): Observable<TaskInterface[]> {
    const params = { status: 'PENDING' };
    return this.http.get<Array<TaskInterface>>(DataTasksService.url, {
      params,
    });
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
    return this.http.patch<TaskInterface>(
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
  /**
   * Renvoie un observable auquel on peut s'abonner (todoList)
   * @returns  Observable
   */
  getFormValuesObservable(): Observable<any> {
    return this.formValues$.asObservable();
  }
  /**
   * Fait une requête http post pour ajouter une tâche sur le serveur et renvoie un observable auquel on peut s'abonner
   * @param newObject
   * @returns Observable<TaskInterface>
   */
  postTask(newObject: PartialTaskInterface): Observable<TaskInterface> {
    const params = { status: 'PENDING' };
    return this.http.post<TaskInterface>(DataTasksService.url, newObject, {
      params,
    });
  }
}
