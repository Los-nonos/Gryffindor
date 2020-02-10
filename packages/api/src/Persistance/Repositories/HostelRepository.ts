import Hostel from '../../Domain/Entities/Hostel';
import { getRepository, Repository } from 'typeorm';
import IHostelRepository from '../../Domain/Interfaces/IHostelRepository';
import { EntityNotFound } from '../../Infraestructure/Errors/EntityNotFound';

class HostelRepository implements IHostelRepository {
  private repository: Repository<Hostel>;

  constructor() {
    this.repository = getRepository(Hostel);
  }

  public async FindById(id: number): Promise<Hostel> {
    return await this.repository.findOne({ Id: id });
  }

  public async Find(): Promise<Hostel[]> {
    return await this.repository.find();
  }

  public async Persist(t: Hostel): Promise<Hostel> {
    return await this.repository.save(t);
  }

  public async Update(t: Hostel): Promise<void> {
    const result = await this.repository.update({ Id: t.Id }, t);
    if (!result.affected) {
      throw new EntityNotFound('');
    }
  }

  public async Delete(t: Hostel): Promise<void> {
    const result = await this.repository.remove(t);
    if (!result) {
      throw new EntityNotFound('');
    }
  }
}

export default HostelRepository;
