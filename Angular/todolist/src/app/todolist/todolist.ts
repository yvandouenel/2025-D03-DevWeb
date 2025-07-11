import { Component } from '@angular/core';
import {
  PartialTaskInterface,
  TaskInterface,
} from '../../interfaces/TaskInterface';
import { CommonModule } from '@angular/common';
import { Task } from './task/task';
import { DataTasksService } from './../data-tasks';
import { FormAdd } from './form-add/form-add';

@Component({
  selector: 'digi-todolist',
  imports: [CommonModule, Task, FormAdd],

  templateUrl: './todolist.html',
  styleUrl: './todolist.css',
})
export class Todolist {
  // Propriétés
  protected title: string = 'Todolist';
  protected tasks!: TaskInterface[];
  protected errorMsg: string = '';

  // Constructor avec injection de service
  constructor(private dataTasksService: DataTasksService) {
    // Assignation en appelant la méthode loadTasks du service DataTasksService
    /* this.tasks = dataTasksService.loadTasks(); */
  }
  ngOnInit(): void {
    // Souscription à l'obeservable issu de loadTasks
    this.dataTasksService.loadTasks().subscribe({
      next: (tasks: TaskInterface[]) => {
        console.log(`Next : Donnée issue de l'obersable reçue`);
        this.tasks = tasks;
      },
      error: (error) => {
        console.error(
          `Erreur issue de l'Observable de loadTasks attrapée`,
          error
        );
      },
      complete: () => {
        console.log(`Complete : Observable issu de loadTasks terminé`);
      },
    });

    // Souscription à l'observable qui émet des valeurs via addTask
    this.dataTasksService.getFormValuesObservable().subscribe({
      next: (dataFromForm) => {
        console.log(`Data dans Todolist`, dataFromForm);
        // Ajout d'une nouvelle tâche localement au tableau tasks
        const newTask = {
          ...dataFromForm,
          done: false,
        };
        const newLocalTask = {
          ...newTask,
          id: Math.round(Math.random() * 100).toString(),
        };
        this.tasks.push(newLocalTask);

        console.log(`Tache ajoutée : `, newLocalTask);

        // Envoie via une requête http post de la nouvelle tâche au serveur
        this.dataTasksService.postTask(newTask).subscribe({
          next: (newTaskFromServer) => {
            console.log(
              `Nouvelle tâche ajoutée sur le serveur`,
              newTaskFromServer
            );
            // Modification de pour que l'id soit la même que sur le serveur json-serveur
            newLocalTask.id = newTaskFromServer.id;
            console.log(`this.tasks`, this.tasks);
          },
          error: (error) => {
            console.error(`Erreur attrapée :`, error);
            // Prévenir l'utilisateur
            this.errorMsg =
              "Problème lors de l'ajout en base de données de la nouvelle tâche";
            setTimeout(() => {
              this.errorMsg = '';
            }, 5000);
            // Revenir en arrière en supprimant la task que je viens d'ajouter dans tasks
            setTimeout(() => {
              this.tasks.pop();
            }, 4000);
          },
        });
      },
      error: (error) => {
        console.log(
          `Erreur attrapée lors de la souscription à l'observable dasn todoList`
        );
      },
    });
  }

  // Méthodes
}
