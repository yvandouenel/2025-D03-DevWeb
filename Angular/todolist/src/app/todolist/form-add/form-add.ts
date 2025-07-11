import { Component } from '@angular/core';
import { DataTasksService } from '../../data-tasks';
import {
  FormBuilder,
  FormGroup,
  Validators,
  ReactiveFormsModule,
} from '@angular/forms';
@Component({
  selector: 'digi-form-add',
  imports: [ReactiveFormsModule],
  templateUrl: './form-add.html',
  styleUrl: './form-add.css',
})
export class FormAdd {
  formAddGroup!: FormGroup;
  constructor(
    private fb: FormBuilder,
    private dataTasksService: DataTasksService
  ) {}

  ngOnInit() {
    this.formAddGroup = this.fb.group({
      name: ['', [Validators.required]],
      comment: ['', [Validators.required]],
    });
  }
  onSubmit() {
    console.log(`dans onSubmit`);
    // Récupérer la donnée de la tâche (name et comment)
    console.log(`valeurs du formulaire`, this.formAddGroup.value);

    // Afficher les valeurs de la nouvelle tâche dans un template
    // Ici on va émettre une valeur next d'un observable qui fait partie d'un service
    this.dataTasksService.setFormValues(this.formAddGroup.value);

    // Enregister cette nouvelle tâche dans la base de donnée (via json-server)
  }
}
