import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import FindHostelCommand from '../../Commands/Hostel/FindHostelCommand';
import IHostelRepository from '../../../Domain/Interfaces/IHostelRepository';
import INTERFACES from '../../../Infraestructure/types';
import Hostel from '../../../Domain/Entities/Hostel';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';

@injectable()
class FindHostelHandler {
  private repository: IHostelRepository;
  constructor(@inject(INTERFACES.IHostelRepository) repository: IHostelRepository) {
    this.repository = repository;
  }
  public async execute(command: FindHostelCommand): Promise<Hostel[]> {
    const hostels = await this.repository.Find({
      Name: command.getName(),
      Email: command.getEmail(),
      Cuit: command.getCuit(),
      Address: command.getAddress(),
    });

    if (!hostels) {
      throw new EntityNotFound(
        `Not hostels found with name ${command.getName()}, email ${command.getEmail()} cuit ${command.getCuit()} and address ${command.getAddress()}`,
      );
    } else {
      return hostels;
    }
  }
}

export default FindHostelHandler;
