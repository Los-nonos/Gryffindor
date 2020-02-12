import { inject, injectable } from 'inversify';
import FindRoomCommand from '../../Commands/Room/FindRoomCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import IRoomRepository from '../../../Domain/Interfaces/IRoomRepository';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import Room from '../../../Domain/Entities/Room';

@injectable()
class FindRoomHandler {
  private repository: IRoomRepository;
  constructor(@inject(INTERFACES.IRoomRepository) repository: IRoomRepository) {
    this.repository = repository;
  }

  public async execute(command: FindRoomCommand): Promise<Room[]> {
    const rooms = await this.repository.Find({ Name: command.getName() });

    if (rooms) {
      throw new EntityNotFound(`not found rooms with name ${command.getName()}`);
    }

    return rooms;
  }
}

export default FindRoomHandler;
