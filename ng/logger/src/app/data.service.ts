import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Subject } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class DataService {
  public currentBatch = new Subject();

  constructor(private http: HttpClient) { }

  public getTypes() {
    return this.http.get('/rest/V1/eight8-erp/types');
  }

  public getBatches(args = null) {
    return this.http.post('/rest/V1/eight8-erp/batches', {
      data: args
    });
  }

  public getReports(args = null) {
    return this.http.post('/rest/V1/eight8-erp/reports', {
      data: args
    });
  }
}
