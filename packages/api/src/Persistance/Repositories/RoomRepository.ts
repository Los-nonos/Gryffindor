import Room from '../../Domain/Entities/Room';
import { getRepository, Repository } from 'typeorm';
import IRoomRepository from '../../Domain/Interfaces/IRoomRepository';
import { EntityNotFound } from '../../Infraestructure/Errors/EntityNotFound';

class RoomRepository implements IRoomRepository {
	private repository: Repository<Room>;

	constructor() {
		this.repository = getRepository(Room);
	}

	public async FindById(id: number): Promise<Room> {
		return await this.repository.findOne({ Id: id });
	}

	public async Find(): Promise<Room[]> {
		return await this.repository.find();
	}

	public async Persist(t: Room): Promise<Room> {
		return await this.repository.save(t);
	}

	public async Update(t: Room): Promise<void> {
		const result = await this.repository.update({ Id: t.Id }, t);
		if(!result.affected) {
			throw new EntityNotFound('');
		}
	}

	public async Delete(t: Room): Promise<void> {
		const result = await this.repository.remove(t);
		if(!result) {
			throw new EntityNotFound('');
		}
	}
}

export default RoomRepository
