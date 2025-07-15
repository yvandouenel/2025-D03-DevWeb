import { Routes } from '@angular/router';
import { Todolist } from './todolist/todolist';
import { About } from './about/about';

export const routes: Routes = [
  { path: 'about', component: About },
  { path: '', component: Todolist },
];
