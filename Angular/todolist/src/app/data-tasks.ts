import { Injectable } from '@angular/core';
import {
  PartialTaskInterface,
  TaskInterface,
} from '../interfaces/TaskInterface';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class DataTasksService {
  static url = 'http://localhost:3000/tasks';
  constructor(private http: HttpClient) {}
  loadTasks(): Observable<TaskInterface[]> {
    const params = { status: 'PENDING' };
    return this.http.get<Array<TaskInterface>>(DataTasksService.url, {
      params,
    });
  }
  patchTasks(
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
}
