import { Component } from '@angular/core';
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
  constructor(private fb: FormBuilder) {}

  ngOnInit() {
    this.formAddGroup = this.fb.group({
      name: ['', [Validators.required]],
      comment: [''],
    });
  }
  onSubmit() {
    console.log(`dans onSubmit`);
  }
}
