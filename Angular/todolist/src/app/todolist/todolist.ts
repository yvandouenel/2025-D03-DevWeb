import { Component } from '@angular/core';
import { TaskInterface } from '../../interfaces/TaskInterface';
import { CommonModule } from '@angular/common';
import { Task } from './task/task';
import { DataTasksService } from './../data-tasks';

@Component({
  selector: 'digi-todolist',
  imports: [CommonModule, Task],

  templateUrl: './todolist.html',
  styleUrl: './todolist.css',
})
export class Todolist {
  // Propriétés
  protected title: string = 'Todolist';
  protected tasks!: TaskInterface[];
  // Constructor avec injection de service
  constructor(private dataTasksService: DataTasksService) {
    // Assignation en appelant la méthode loadTasks du service DataTasksService
    /* this.tasks = dataTasksService.loadTasks(); */
  }
  ngOnInit(): void {
    // Vla la souscription
    this.dataTasksService.loadTasks().subscribe({
      next: (tasks: TaskInterface[]) => {
        this.tasks = tasks;
      },
      error: (error) => {
        console.error(
          `Erreur issue de l'Observable de loadTasks attrapée`,
          error
        );
      },
      complete: () => {
        console.log(`Observable issu de loadTasks terminé`);
      },
    });
  }

  // Méthodes
}
