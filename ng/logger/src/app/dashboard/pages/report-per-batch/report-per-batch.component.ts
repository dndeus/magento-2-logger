import { Component, EventEmitter, OnDestroy, OnInit, Output } from '@angular/core';
import { Report } from "../../../Models/Report";
import { MatDialog } from "@angular/material/dialog";
import { Subscription } from "rxjs";
import { DataService } from "../../../data.service";

@Component({
  selector: 'app-report-per-batch',
  templateUrl: './report-per-batch.component.html',
  styleUrls: ['./report-per-batch.component.css']
})
export class ReportPerBatchComponent implements OnInit, OnDestroy {
  @Output('goBack') goBack = new EventEmitter();

  public loading: boolean = true;
  public reports: Report[] = [];
  public report: Report;
  private currentBatchSub = new Subscription();
  public status: string = null;
  private batchId = null;
  public from = 0;
  public to = 0;
  public of = 0;
  public prev = null;
  public next = null;
  constructor(public dialog: MatDialog, private dataSrv: DataService) {
    this.currentBatchSub = this.dataSrv.currentBatch.subscribe({
      next: (currentBatch) => {
        this.batchId = currentBatch;
        this.getData()
      }
    })
  }

  ngOnInit(): void {

  }

  private createFilters() {
    return  {
      batch_id: this.batchId,
      page: 'page=1',
      status: this.status
    }
  }

  public search() {
    const filter = this.createFilters()

    this.getData(filter)
  }

  public loadPage(page = null) {
    if (page === null)
      return
    const filter = this.createFilters()
    filter.page = page;
    // console.log(filter)
    this.getData(filter)
  }


  private getData(args = {batch_id: null, page: 'page=1'}) {
    args.batch_id = this.batchId;
    this.loading = true;
    this.dataSrv.getReports(args).subscribe(
      (data: any) => {
        this.reports = data[1];
        this.report = data[1][0];
        this.from = data[3];
        this.to = data[10];
        this.of = data[11];
        this.next = data[6];
        this.prev = data[9];
        this.loading = false;
      }
    )
  }

  ngOnDestroy(): void {
    this.currentBatchSub.unsubscribe();
  }
}
