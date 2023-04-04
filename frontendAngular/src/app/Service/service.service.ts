import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Producto } from '../Modelo/Producto';
import { GlobalComponent } from 'src/app/global-component';

@Injectable({
  providedIn: 'root'
})
export class ServiceService {

  constructor(private http:HttpClient) { }

  Url = GlobalComponent.appUrlWS;

  getProductos(){
    return this.http.get<Producto[]>(this.Url+"GetAll");

    /*let header = new HttpHeaders()
    .set('Type-content','aplication/json');

    return this.http.get(this.Url, {
      headers: header
    });*/
  }

  getProductoId(id:String){
    const headers = {'Content-Type': 'application/json'};
    const body = { idproducto: id };
    //console.log('idproducto: '+body);
    return this.http.post<Producto>(this.Url+"GetId", body, {'headers':headers});
  }

}
