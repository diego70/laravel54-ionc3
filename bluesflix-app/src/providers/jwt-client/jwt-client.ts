import { Injectable } from '@angular/core';
import {Http, Response} from '@angular/http';
import 'rxjs/add/operator/map';
import {JwtCredentials} from "../../models/jwt-credentials";
import {Storage} from "@ionic/storage";
import {JwtHelper} from "angular2-jwt";

/*
  Generated class for the JwtClientProvider provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/

@Injectable()
export class JwtClientProvider {

    private _token = null;
    private _payload = null;

  constructor(
      public http: Http,
      public storage: Storage,
      public jwtHelper: JwtHelper
  ) {
    this.getToken();
    this.getPayload().then((payload)=>{
         console.log(payload);
    })

  }
    getPayload():Promise<Object> {

      console.log(this._payload);
        return new Promise((resolve) => {
            if (this._payload) {
                resolve(this._payload);
            }
            this.getToken().then((token) => {
                if (token) {
                    this._payload = this.jwtHelper.decodeToken(token)
                }
                resolve(this._payload);
            });
        });
    }

  getToken():Promise<string>{
      return new Promise((resolve)=>{
          if(this._token){
              resolve(this._token);
          }
          this.storage.get('token').then((token)=>{
              this._token=token;
              console.log(this._token);
          });
      });
  }

  accessToken(jwtCredentials: JwtCredentials):Promise<string>{
      return this.http.post('http://127.0.0.1:8000/api/access_token', jwtCredentials)
          .toPromise()
          .then((response: Response)=>{
              let token = response.json().token;
              this._token = token;
              this.storage.set('token', this._token);
              return token;
          });
  }

}
