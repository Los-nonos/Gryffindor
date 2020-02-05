import { Container } from 'inversify';
import 'reflect-metadata';
// import TYPES from './types';

//Erros imports
import ErrorHandler from '../Infraestructure/utils/ErrorHandler';



import Validator from '../API/Http/Validator/Validator';

var container = new Container();


// Errors services
container.bind<ErrorHandler>(ErrorHandler).toSelf();

container.bind<Validator>(Validator).toSelf();

export default container;
