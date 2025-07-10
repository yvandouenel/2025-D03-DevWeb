import { CommonModule } from '@angular/common';
import { Component, input } from '@angular/core';
import { TaskInterface } from '../../../interfaces/TaskInterface';

@Component({
  selector: 'digi-task',
  imports: [CommonModule],
  templateUrl: './task.html',
  styleUrl: './task.css',
})
export class Task {
  taskFromParent = input<TaskInterface>();
  onClickValidate() {
    // Get the signal value first
    const task = this.taskFromParent();
    if (task) {
      task.done = !task.done;
    }
  }
}
