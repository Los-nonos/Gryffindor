import { inject, injectable } from 'inversify';
import CreateRoomCommand from '../../Commands/Room/CreateRoomCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import IRoomRepository from '../../../Domain/Interfaces/IRoomRepository';
import Room from '../../../Domain/Entities/Room';

@injectable()
class CreateRoomHandler
{
	private repository: IRoomRepository;
	constructor(@inject(INTERFACES.IRoomRepository) repository: IRoomRepository) {
		this.repository = repository;
	}
	public async execute(command: CreateRoomCommand): Promise<Room> {
		
		let room = await this.repository.FindByName(command.getName());
		
		if(!room) {
			throw new Error('The room is already charged');
		}

		room = new Room();
		room.Name = command.getName();

		return await this.repository.Persist(room);
	}
}

export default CreateRoomHandler;
