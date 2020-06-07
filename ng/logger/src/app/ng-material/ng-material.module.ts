import { NgModule } from '@angular/core';
import { MatSelectModule } from "@angular/material/select";
import { MatChipsModule } from "@angular/material/chips";
import { MatNativeDateModule } from "@angular/material/core";
import { MatInputModule } from "@angular/material/input";
import { MatDatepickerModule } from "@angular/material/datepicker";
import { MatButtonModule } from "@angular/material/button";
import { MatDialogModule } from "@angular/material/dialog";
import { MatStepperModule } from "@angular/material/stepper";


@NgModule({
  exports: [
    MatSelectModule,
    MatChipsModule,
    MatNativeDateModule,
    MatInputModule,
    MatDatepickerModule,
    MatButtonModule,
    MatDialogModule,
    MatStepperModule
  ]
})
export class NgMaterialModule { }
