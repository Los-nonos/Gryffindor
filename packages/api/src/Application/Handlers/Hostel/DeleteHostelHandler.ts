import { inject, injectable } from 'inversify';
import DeleteHostelCommand from '../../Commands/Hostel/DeleteHostelCommand';
import INTERFACES from '../../../Infraestructure/types';
import IHostelRepository from '../../../Domain/Interfaces/IHostelRepository';
import Hostel from '../../../Domain/Entities/Hostel';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';

@injectable()
class DeleteHostelHandler {
  private repository: IHostelRepository;
  constructor(@inject(INTERFACES.IHostelRepository) repository: IHostelRepository) {
    this.repository = repository;
  }
  public async execute(command: DeleteHostelCommand): Promise<void> {
    const hostel = await this.repository.FindById(command.getId());

    if (!hostel) {
      throw new EntityNotFound(`the hostel with id ${command.getId()} not exist`);
    }

    await this.repository.Delete(hostel);
  }
}

export default DeleteHostelHandler;
