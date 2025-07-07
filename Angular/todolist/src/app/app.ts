import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { Todolist } from './todolist/todolist';

@Component({
  selector: 'digi-root',
  imports: [CommonModule, RouterOutlet, Todolist],
  templateUrl: './app.html',
  styleUrl: './app.css',
})
export class App {}
