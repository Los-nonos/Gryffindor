import Hostel from '../Entities/Hostel';

export default interface IHostelRepository {
  FindById(id: number): Promise<Hostel>;
  Find(params: any): Promise<Hostel[]>;
  Persist(t: Hostel): Promise<Hostel>;
  Update(t: Hostel): Promise<void>;
  Delete(t: Hostel): Promise<void>;
}
