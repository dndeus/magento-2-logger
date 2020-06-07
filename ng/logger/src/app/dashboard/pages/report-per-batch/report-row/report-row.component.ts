import { Component, Input, OnInit } from '@angular/core';
import { Report } from "../../../../Models/Report";
import { MatDialog } from "@angular/material/dialog";
import { ReportDataModalComponent } from "../report-data-modal/report-data-modal.component";

@Component({
  selector: '[report-row]',
  templateUrl: './report-row.component.html',
  styleUrls: ['./report-row.component.css']
})
export class ReportRowComponent implements OnInit {
  @Input('report') report: Report;

  constructor(public dialog: MatDialog) { }

  ngOnInit(): void {
  }

  openDialog(report): void {
    const dialogRef = this.dialog.open(ReportDataModalComponent, {
      data: report
    });

    dialogRef.afterClosed().subscribe(result => {
      //console.log('The dialog was closed');
    });
  }

  reRun() {
    this.report.completed = true;
  }
}
