import { inject, injectable } from 'inversify';
import DeleteRoomCommand from '../../Commands/Room/DeleteRoomCommand';
import IRoomRepository from '../../../Domain/Interfaces/IRoomRepository';
import INTERFACES from '../../../Infraestructure/DI/types';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';

@injectable()
class DeleteRoomHandler {
  private repository: IRoomRepository;

  constructor(@inject(INTERFACES.IRoomRepository) repository: IRoomRepository) {
    this.repository = repository;
  }

  public async execute(command: DeleteRoomCommand): Promise<void> {
    const room = await this.repository.FindById(command.getId());
    if (!room) {
      throw new EntityNotFound('room not found');
    }

    await this.repository.Delete(room);
  }
}

export default DeleteRoomHandler;
