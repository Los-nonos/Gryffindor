import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import FindByIdRoomCommand from '../../Commands/Room/FindByIdRoomCommand';
import IRoomRepository from '../../../Domain/Interfaces/IRoomRepository';
import INTERFACES from '../../../Infraestructure/DI/types';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import Room from '../../../Domain/Entities/Room';

@injectable()
class FindByIdRoomHandler {
  private repository: IRoomRepository;
  constructor(@inject(INTERFACES.IRoomRepository) repository: IRoomRepository) {
    this.repository = repository;
  }
  public async execute(command: FindByIdRoomCommand): Promise<Room> {
    const room = await this.repository.FindById(command.getId());

    if (!room) {
      throw new EntityNotFound(`room not found with id: ${command.getId()}`);
    }

    return room;
  }
}

export default FindByIdRoomHandler;
