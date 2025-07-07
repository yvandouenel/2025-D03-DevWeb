import { Component } from '@angular/core';
import { TaskInterface } from '../../interfaces/TaskInterface';
import { CommonModule } from '@angular/common';
import { Task } from './task/task';

@Component({
  selector: 'digi-todolist',
  imports: [CommonModule, Task],
  templateUrl: './todolist.html',
  styleUrl: './todolist.css',
})
export class Todolist {
  protected title: string = 'Todolist';
  protected tasks: TaskInterface[] = [
    {
      id: '1',
      name: 'Faire la vaisselle',
      done: true,
      comment:
        'Dépêche toi mon lapin, je ne supporte pas de voir traîner la vaisselle',
    },
    {
      id: '2',
      name: 'Faire le ménage',
      done: false,
    },
  ];

  // Méthodes
}
