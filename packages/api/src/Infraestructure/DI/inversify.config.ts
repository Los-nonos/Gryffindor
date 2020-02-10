import { Container } from 'inversify';
import 'reflect-metadata';
import TYPES from './types';

import CreateRoomAction from '../../API/Http/Actions/Room/CreateRoomAction';
import DeleteRoomAction from '../../API/Http/Actions/Room/DeleteRoomAction';
import EditRoomAction from '../../API/Http/Actions/Room/EditRoomAction';
import FindByIdRoomAction from '../../API/Http/Actions/Room/FindByIdRoomAction';
import FindRoomAction from '../../API/Http/Actions/Room/FindRoomAction';

import CreateRoomAdapter from '../../API/Http/Adapters/Room/CreateRoomAdapter';
import DeleteRoomAdapter from '../../API/Http/Adapters/Room/DeleteRoomAdapter';
import EditRoomAdapter from '../../API/Http/Adapters/Room/EditRoomAdapter';
import FindByIdRoomAdapter from '../../API/Http/Adapters/Room/FindByIdRoomAdapter';
import FindRoomAdapter from '../../API/Http/Adapters/Room/FindRoomAdapter';

import CreateRoomHandler from '../../Application/Handlers/Room/CreateRoomHandler';
import DeleteRoomHandler from '../../Application/Handlers/Room/DeleteRoomHandler';
import EditRoomHandler from '../../Application/Handlers/Room/EditRoomHandler';
import FindByIdRoomHandler from '../../Application/Handlers/Room/FindByIdRoomHandler';
import FindRoomHandler from '../../Application/Handlers/Room/FindRoomHandler';

import RoomRepository from '../../Persistance/Repositories/RoomRepository';
import IRoomRepository from '../../Domain/Interfaces/IRoomRepository';

//Erros imports
import ErrorHandler from '../utils/ErrorHandler';

import Validator from '../../API/Http/Validator/Validator';

var container = new Container();

// Errors services
container.bind<ErrorHandler>(ErrorHandler).toSelf();

container.bind<Validator>(Validator).toSelf();

container.bind<CreateRoomAction>(CreateRoomAction).toSelf();
container.bind<DeleteRoomAction>(DeleteRoomAction).toSelf();
container.bind<EditRoomAction>(EditRoomAction).toSelf();
container.bind<FindByIdRoomAction>(FindByIdRoomAction).toSelf();
container.bind<FindRoomAction>(FindRoomAction).toSelf();

container.bind<CreateRoomAdapter>(CreateRoomAdapter).toSelf();
container.bind<DeleteRoomAdapter>(DeleteRoomAdapter).toSelf();
container.bind<EditRoomAdapter>(EditRoomAdapter).toSelf();
container.bind<FindByIdRoomAdapter>(FindByIdRoomAdapter).toSelf();
container.bind<FindRoomAdapter>(FindRoomAdapter).toSelf();

container.bind<CreateRoomHandler>(CreateRoomHandler).toSelf();
container.bind<DeleteRoomHandler>(DeleteRoomHandler).toSelf();
container.bind<EditRoomHandler>(EditRoomHandler).toSelf();
container.bind<FindByIdRoomHandler>(FindByIdRoomHandler).toSelf();
container.bind<FindRoomHandler>(FindRoomHandler).toSelf();

container.bind<IRoomRepository>(TYPES.IRoomRepository).to(RoomRepository);

export default container;
