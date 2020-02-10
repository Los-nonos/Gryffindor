import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import EditRoomCommand from '../../Commands/Room/EditRoomCommand';
import IRoomRepository from '../../../Domain/Interfaces/IRoomRepository';
import INTERFACES from '../../../Infraestructure/DI/types';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import Room from '../../../Domain/Entities/Room';

@injectable()
class EditRoomHandler {
  private repository: IRoomRepository;
  constructor(@inject(INTERFACES.IRoomRepository) repository: IRoomRepository) {
    this.repository = repository;
  }

  public async execute(command: EditRoomCommand): Promise<Room> {
    const room = await this.repository.FindById(command.getId());

    if (!room) {
      throw new EntityNotFound('room not found');
    }

    room.Name = command.getName();

    await this.repository.Update(room);

    return room;
  }
}

export default EditRoomHandler;
