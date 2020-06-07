import { Component, Inject, OnInit } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from "@angular/material/dialog";
import { Report } from "../../../../Models/Report";
import { JSONprettyPrint } from "../../../../Helpers/JSONprettyPrint";

@Component({
  selector: 'app-report-data-modal',
  templateUrl: './report-data-modal.component.html',
  styleUrls: ['./report-data-modal.component.css']
})
export class ReportDataModalComponent implements OnInit {
  public pretty: JSONprettyPrint = new JSONprettyPrint();

  constructor(
    public dialogRef: MatDialogRef<ReportDataModalComponent>,
    @Inject(MAT_DIALOG_DATA) public report: Report) {
  }

  onNoClick(): void {
    this.dialogRef.close();
  }
  ngOnInit(): void {
    //console.log(this.report)
  }

}
