import { inject, injectable } from 'inversify';
import FindByIdHostelCommand from '../../Commands/Hostel/FindByIdHostelCommand';
import INTERFACES from '../../../Infraestructure/types';
import IHostelRepository from '../../../Domain/Interfaces/IHostelRepository';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import Hostel from '../../../Domain/Entities/Hostel';

@injectable()
class FindByIdHostelHandler {
  private repository: IHostelRepository;
  constructor(@inject(INTERFACES.IHostelRepository) repository: IHostelRepository) {
    this.repository = repository;
  }
  public async execute(command: FindByIdHostelCommand): Promise<Hostel> {
    const hostel = await this.repository.FindById(command.getId());

    if (!hostel) {
      throw new EntityNotFound(`Hostel not found with id ${command.getId()}`);
    } else {
      return hostel;
    }
  }
}

export default FindByIdHostelHandler;
