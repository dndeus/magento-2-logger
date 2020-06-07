import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import {Batch} from "../../../Models/Batch";
import { MatDialog } from "@angular/material/dialog";
import { ReportPerBatchComponent } from "../report-per-batch/report-per-batch.component";
import { DataService } from "../../../data.service";

@Component({
  selector: 'app-overview',
  templateUrl: './overview.component.html',
  styleUrls: ['./overview.component.css']
})
export class OverviewComponent implements OnInit {
  @Output('nextStep') nextStep = new EventEmitter();

  public loading: boolean = true;
  public batches: Batch[] = [];
  public types: string[] = [];
  public type: string = null;
  public dp = {from: null, to: null}
  public from = 0;
  public to = 0;
  public of = 0;
  public prev = null;
  public next = null;
  constructor(public dialog: MatDialog, private dataSrv: DataService) {
    this.dataSrv.getTypes().subscribe(
      (data: any) => {
        this.types = data;
      }
    )

  }

  ngOnInit(): void {
    this.getData()
  }

  private createFilters() {
    let from = null;
    let to = null;
    if (this.dp.from !== null) {
      from = new Date(this.dp.from);
      from = from?.getFullYear() + '-' + ( from?.getMonth() + 1 ) + '-' + from?.getDate();
    }
    if (this.dp.to !== null) {
      to = new Date(this.dp.to);
      to = to?.getFullYear() + '-' + ( to?.getMonth() + 1 ) + '-' + to?.getDate();
    }
    return  {
      from,
      to,
      page: 'page=1',
      type: this.type
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

  private getData(args = {page: 'page=1'}) {
    this.loading = true;
    this.dataSrv.getBatches(args).subscribe(
      (data: any) => {
        this.batches = data[1];
        this.from = data[3];
        this.to = data[10];
        this.of = data[11];
        this.next = data[6];
        this.prev = data[9];
        this.loading = false;
      }
    )
  }

  goToReport(id): void {
    this.dataSrv.currentBatch.next(id);
    this.nextStep.emit(true);
  }
}
