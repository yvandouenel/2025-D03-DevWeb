import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormAdd } from './form-add';

describe('FormAdd', () => {
  let component: FormAdd;
  let fixture: ComponentFixture<FormAdd>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FormAdd]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FormAdd);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
