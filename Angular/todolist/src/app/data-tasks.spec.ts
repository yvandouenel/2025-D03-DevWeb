import { TestBed } from '@angular/core/testing';

import { DataTasks } from './data-tasks';

describe('DataTasks', () => {
  let service: DataTasks;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(DataTasks);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
