import { Container } from 'inversify';
import 'reflect-metadata';
import TYPES from './types';

import CreateHostelAction from '../API/Http/Actions/Hostel/CreateHostelAction';
import EditHostelAction from '../API/Http/Actions/Hostel/EditHostelAction';
import DeleteHostelAction from '../API/Http/Actions/Hostel/DeleteHostelAction';
import FindByIdHostelAction from '../API/Http/Actions/Hostel/FindByIdHostelAction';
import FindHostelAction from '../API/Http/Actions/Hostel/FindHostelAction';

import CreateHostelAdapter from '../API/Http/Adapters/Hostel/CreateHostelAdapter';
import EditHostelAdapter from '../API/Http/Adapters/Hostel/EditHostelAdapter';
import DeleteHostelAdapter from '../API/Http/Adapters/Hostel/DeleteHostelAdapter';
import FindByIdHostelAdapter from '../API/Http/Adapters/Hostel/FindByIdHostelAdapter';
import FindHostelAdapter from '../API/Http/Adapters/Hostel/FindHostelAdapter';

import CreateHostelHandler from '../Application/Handlers/Hostel/CreateHostelHandler';
import EditHostelHandler from '../Application/Handlers/Hostel/EditHostelHandler';
import DeleteHostelHandler from '../Application/Handlers/Hostel/DeleteHostelHandler';
import FindByIdHostelHandler from '../Application/Handlers/Hostel/FindByIdHostelHandler';
import FindHostelHandler from '../Application/Handlers/Hostel/FindHostelHandler';

import IHostelRepository from '../Domain/Interfaces/IHostelRepository';

import HostelRepository from '../Persistance/Repositories/HostelRepository';

//Erros imports
import ErrorHandler from '../Infraestructure/utils/ErrorHandler';

import Validator from '../API/Http/Validator/Validator';

var container = new Container();

// Errors services
container.bind<ErrorHandler>(ErrorHandler).toSelf();

container.bind<CreateHostelAction>(CreateHostelAction).toSelf();
container.bind<EditHostelAction>(EditHostelAction).toSelf();
container.bind<DeleteHostelAction>(DeleteHostelAction).toSelf();
container.bind<FindByIdHostelAction>(FindByIdHostelAction).toSelf();
container.bind<FindHostelAction>(FindHostelAction).toSelf();

container.bind<CreateHostelAdapter>(CreateHostelAdapter).toSelf();
container.bind<EditHostelAdapter>(EditHostelAdapter).toSelf();
container.bind<DeleteHostelAdapter>(DeleteHostelAdapter).toSelf();
container.bind<FindByIdHostelAdapter>(FindByIdHostelAdapter).toSelf();
container.bind<FindHostelAdapter>(FindHostelAdapter).toSelf();

container.bind<CreateHostelHandler>(CreateHostelHandler).toSelf();
container.bind<EditHostelHandler>(EditHostelHandler).toSelf();
container.bind<DeleteHostelHandler>(DeleteHostelHandler).toSelf();
container.bind<FindByIdHostelHandler>(FindByIdHostelHandler).toSelf();
container.bind<FindHostelHandler>(FindHostelHandler).toSelf();

container.bind<IHostelRepository>(TYPES.IHostelRepository).to(HostelRepository);

container.bind<Validator>(Validator).toSelf();

export default container;
