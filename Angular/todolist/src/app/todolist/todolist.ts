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
        const localTaskId = Math.round(Math.random() * 100).toString();
        const newLocalTask = {
          ...newTask,
          id: localTaskId,
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
              this.tasks = this.tasks.filter((task) => task.id != localTaskId);
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

    // Souscription à l'observable qui émet des valeurs via le bouton delelte d'une tâche
    this.dataTasksService.getDeleteTaskIdObservable().subscribe({
      next: (id: string) => {
        console.log(`Dans next de getDeleteTaskIdObservable().subscribe`);
        // Copie de la tâche qui est supprimée
        let savedTask!: TaskInterface;
        // Suppresion de la tâche en local en agissant sur this.tasks
        this.tasks = this.tasks.filter((task) => {
          // Pour passer le filtre, la tâche ne doit pas avoir pour identité id
          if (task.id == id) savedTask = task;
          return task.id !== id;
        });
        // Suppresion de la tâche en base de données en passant par le service qui va faire une requête HTTP avec la méthode DELETE
        this.dataTasksService.deleteTask(id).subscribe({
          next: (taskDeleted) => {
            console.log(`Tâche supprimée `, taskDeleted);
          },
          error: (error) => {
            console.error(`Problème pour supprimer la tâche dans todolist `);
            // Remettre la tâche supprimée
            this.tasks.push(savedTask);

            // Informer l'utilisateur
            this.errorMsg =
              "La tâche n'a pas été supprimée en base de données.";
            setTimeout(() => {
              this.errorMsg = '';
            }, 5000);
          },
        });
      },
      error: (error) => {
        console.error(
          `Erreur attrapée lors de la suppression de la tâche`,
          error
        );
      },
    });
  }

  // Méthodes
}
