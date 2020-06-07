import { BrowserModule } from '@angular/platform-browser';
import { Injector, NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { DashboardComponent } from './dashboard/dashboard/dashboard.component';
import { OverviewComponent } from './dashboard/pages/overview/overview.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgMaterialModule } from "./ng-material/ng-material.module";
import { createCustomElement } from "@angular/elements";
import { ReportPerBatchComponent } from './dashboard/pages/report-per-batch/report-per-batch.component';
import { ReportDataModalComponent } from "./dashboard/pages/report-per-batch/report-data-modal/report-data-modal.component";
import { ReportRowComponent } from './dashboard/pages/report-per-batch/report-row/report-row.component';
import { HttpClientModule } from "@angular/common/http";
import { FormsModule } from "@angular/forms";

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    OverviewComponent,
    ReportPerBatchComponent,
    ReportDataModalComponent,
    ReportRowComponent
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    NgMaterialModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  //bootstrap: [AppComponent],
  bootstrap: [],
  entryComponents: [
    DashboardComponent
  ]
})
export class AppModule {

  constructor(private injector: Injector) {
  }

  ngDoBootstrap() {
    const dashboard = createCustomElement(DashboardComponent, {
      injector: this.injector
    });

    customElements.define('eight-erp-reports', dashboard);
  }

}
