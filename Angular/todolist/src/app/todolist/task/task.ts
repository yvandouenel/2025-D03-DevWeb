import { CommonModule } from '@angular/common';
import { Component, input } from '@angular/core';
import { TaskInterface } from '../../../interfaces/TaskInterface';
import { DataTasksService } from '../../data-tasks';

@Component({
  selector: 'digi-task',
  imports: [CommonModule],
  templateUrl: './task.html',
  styleUrl: './task.css',
})
export class Task {
  taskFromParent = input<TaskInterface>();
  constructor(private dataTasksService: DataTasksService) {}

  onClickValidate() {
    // Get the signal value first
    const task = this.taskFromParent();
    if (task) {
      // Toggle sur la propriété done (on inverse)
      task.done = !task.done;
      // Appel de la méthode du service qui renvoie un observable : Donc il faut s'abonner !
      this.dataTasksService.patchTasks(task.id, { done: task.done }).subscribe({
        next: (data) => {
          console.log(`data depuis onClickValidate : `, data);
        },
        error: (error) => {
          console.log(`Erreur attrapée dans onClickValidate`, error);
        },
        complete: () => {
          console.log(`Complete: l'observable est terminé `);
        },
      });
    }

    // Appel du service qui va faire un requête http avec la méthode patch
  }
}
