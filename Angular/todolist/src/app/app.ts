import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { TaskInterface } from '../interfaces/TaskInterface';

@Component({
  selector: 'digi-root',
  imports: [CommonModule, RouterOutlet],
  templateUrl: './app.html',
  styleUrl: './app.css',
})
export class App {
  protected date: Date = new Date();
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
  protected fontWeight = 'bold';
  protected color = 'green';

  // Méthodes
  onClickValidate(id: string) {
    console.log(`click sur bouton Valider`, id);
    // utiliser map pour modifier tasks (attention, map est une fonction pure). Pour modifier la tâche cliquée, on va s'appuyer sur la propriété id
    this.tasks = this.tasks.map((task) => {
      if (task.id == id) task.done = !task.done;
      return task;
    });
  }
}
