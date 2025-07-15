import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import {
  RouterEvent,
  RouterLink,
  RouterLinkActive,
  RouterOutlet,
} from '@angular/router';

@Component({
  selector: 'digi-root',
  imports: [CommonModule, RouterOutlet, RouterLink, RouterLinkActive],
  templateUrl: './app.html',
  styleUrl: './app.css',
})
export class App {
  protected title: string = 'Todolist';
}
