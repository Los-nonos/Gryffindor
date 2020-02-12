import { inject, injectable } from 'inversify';
import CreateHostelCommand from '../../Commands/Hostel/CreateHostelCommand';
import INTERFACES from '../../../Infraestructure/types';
import IHostelRepository from '../../../Domain/Interfaces/IHostelRepository';
import Hostel from '../../../Domain/Entities/Hostel';
import { EntityAlreadyExistError } from '../../Errors/EntityAlreadyExistError';

@injectable()
class CreateHostelHandler {
  private repository: IHostelRepository;
  constructor(@inject(INTERFACES.IHostelRepository) repository: IHostelRepository) {
    this.repository = repository;
  }
  public async execute(command: CreateHostelCommand): Promise<Hostel> {
    let hostel = await this.repository.FindByName(command.getName());

    if (hostel) {
      throw new EntityAlreadyExistError(`this hostel with name ${command.getName()} already exist`);
    }

    hostel = new Hostel();
    hostel.Name = command.getName();
    hostel.Address = command.getAddress();
    hostel.Cuit = command.getCuit();
    hostel.Email = command.getEmail();
    hostel.Password = command.getPassword();
    hostel.TinyDescription = command.getTinyDescription();

    return await this.repository.Persist(hostel);
  }
}

export default CreateHostelHandler;
