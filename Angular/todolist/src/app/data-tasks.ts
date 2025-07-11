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
  loadTasks(): Observable<TaskInterface[]> {
    const params = { status: 'PENDING' };
    return this.http.get<Array<TaskInterface>>(DataTasksService.url, {
      params,
    });
  }
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
  setFormValues(values: any): void {
    this.formValues$.next(values);
  }
  getFormValuesObservable(): Observable<any> {
    return this.formValues$.asObservable();
  }
  postTask(newObject: PartialTaskInterface): Observable<TaskInterface> {
    const params = { status: 'PENDING' };
    return this.http.post<TaskInterface>(DataTasksService.url, newObject, {
      params,
    });
  }
}
