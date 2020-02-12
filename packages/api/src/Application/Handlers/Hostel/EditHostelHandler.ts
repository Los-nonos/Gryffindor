import { inject, injectable } from 'inversify';
import EditHostelCommand from '../../Commands/Hostel/EditHostelCommand';
import IHostelRepository from '../../../Domain/Interfaces/IHostelRepository';
import INTERFACES from '../../../Infraestructure/types';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import Hostel from '../../../Domain/Entities/Hostel';

@injectable()
class EditHostelHandler {
  private repository: IHostelRepository;
  constructor(@inject(INTERFACES.IHostelRepository) repository: IHostelRepository) {
    this.repository = repository;
  }
  public async execute(command: EditHostelCommand): Promise<Hostel> {
    const hostel = await this.repository.FindById(command.getId());

    if (!hostel) {
      throw new EntityNotFound(`Not found hostel with id ${command.getId()}`);
    }

    hostel.Name = command.getName();
    hostel.Address = command.getAddress();
    hostel.Cuit = command.getCuit();
    hostel.Email = command.getEmail();
    hostel.TinyDescription = command.getTinyDescription();

    await this.repository.Update(hostel);

    return hostel;
  }
}

export default EditHostelHandler;
