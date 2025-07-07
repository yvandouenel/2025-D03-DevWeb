import { CommonModule } from '@angular/common';
import { Component, Input } from '@angular/core';
import { TaskInterface } from '../../../interfaces/TaskInterface';

@Component({
  selector: 'digi-task',
  imports: [CommonModule],
  templateUrl: './task.html',
  styleUrl: './task.css',
})
export class Task {
  @Input() taskFromParent!: TaskInterface;
  onClickValidate() {
    // Modifications de this.tasks
    this.taskFromParent.done = !this.taskFromParent.done;
  }
}
